import { Component } from '@angular/core';
import { StorageService } from './_services/storage.service';
import { AuthService } from './_services/auth.service';
import jwt_decode from 'jwt-decode';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
})
export class AppComponent {
  title = 'SPY COMPARE !!!';
  private roles: string[] = [];
  isLoggedIn = false;
  showAdminBoard = false;
  email?: string;

  constructor(
    private storageService: StorageService,
    private authService: AuthService
  ) {}

  ngOnInit(): void {
    //a mettre dans le auth.service pour refacto et appeler ici
    this.isLoggedIn = this.storageService.isLoggedIn();
    if (this.isLoggedIn) {
      const authToken = this.storageService.getUser();
      const token = authToken.token;
      const decodedToken: any = jwt_decode(token);
      this.roles = decodedToken.roles;
      //
      this.showAdminBoard = this.roles.includes('ROLE_ADMIN');

      this.email = decodedToken.email;
    }
  }

  logout(): void {
    this.authService.logout().subscribe({
      next: (res) => {
        console.log(res);
        this.storageService.clean();

        window.location.reload();
      },
      error: (err) => {
        console.log(err);
      },
    });
  }
}
