import { Injectable } from '@angular/core';
import { Observable, tap } from 'rxjs';
import {
  HttpEvent,
  HttpInterceptor,
  HttpHandler,
  HttpRequest,
  HTTP_INTERCEPTORS,
  HttpResponse,
  HttpErrorResponse,
} from '@angular/common/http';
import { StorageService } from '../_services/storage.service';
import { SpinnerService } from '../_services/spinner.service';

@Injectable()
export class HttpRequestInterceptor implements HttpInterceptor {

  constructor(private spinnerService: SpinnerService, private storageService: StorageService) {}

  intercept(
    req: HttpRequest<any>,
    next: HttpHandler
  ): Observable<HttpEvent<any>> {
    const isLoggedIn = this.storageService.isLoggedIn();
    //changer le nom du token (=user)
    if (isLoggedIn) {
      const authToken = this.storageService.getUser();
      const token = authToken.token;
      req = req.clone({
        // withCredentials: true,
        headers: req.headers.set('Authorization', `Bearer ${token}`),
      });
    }
    this.spinnerService.requestStarted();
    return this.handler(next, req);
  }

  handler(next: HttpHandler,req: HttpRequest<any>) : any {
    return next.handle(req)
    .pipe(
      tap(
        (event) => {
          if (event instanceof HttpResponse) {
            this.spinnerService.requestEnded(); //the spinner ended when there is a response
          }
        },
        (error: HttpErrorResponse) => {
          this.spinnerService.resetSpinner()
          throw error;
        }
      )
    )
  }
}

export const HttpInterceptorProviders = [
  { provide: HTTP_INTERCEPTORS, useClass: HttpRequestInterceptor, multi: true },
];
