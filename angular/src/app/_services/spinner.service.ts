import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class SpinnerService {

// it will track "count" and "event"
 private count =0; //count will be starting from 0
 private spinner$ = new BehaviorSubject<string>('');

  constructor() { }

  getSpinnerObserver(): Observable<string> {
    return this.spinner$.asObservable();
  }

  requestStarted() { //initiate to start
    if (++this.count === 1) {
      this.spinner$.next('start');
    }
  }

  requestEnded() { // initiate when the http respond
    if (this.count === 0 || --this.count === 0) {
      this.spinner$.next('stop');
    }
  }
  resetSpinner(){ // return to the previous status just in case
    this.count = 0;
    this.spinner$.next('stop');
  }
}
