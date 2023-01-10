import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../_services/auth.service';
import { StorageService } from '../../_services/storage.service';
import { ApiService } from '../../_services/api.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss'],
})
export class HeaderComponent implements OnInit {
  private roles: string[] = [];
  isLoggedIn = false;
  showAdminBoard = false;
  showModeratorBoard = false;
  email?: string;
  users?: any = [];

  constructor(
    private storageService: StorageService,
    private authService: AuthService,
    private apiService: ApiService
  ) {}

  ngOnInit(): void {
    this.isLoggedIn = this.storageService.isLoggedIn();
    console.log(this.isLoggedIn);

    if (this.isLoggedIn) {
      this.apiService.getCurrentUser().subscribe((user) => {
        this.users = user;

        this.email = this.users.email;
        console.log(this.email);
      });

      /*      this.roles = user.roles;

      this.showAdminBoard = this.roles.includes('ROLE_ADMIN');
      this.showModeratorBoard = this.roles.includes('ROLE_MODERATOR');

      this.email = user.email; */
    }
  }

  logout(): void {
    this.storageService.clean();

    window.location.href = 'login';
    // this.authService.logout().subscribe({
    //   next: (res) => {
    //     console.log(res);
    //     this.storageService.clean();

    //     window.location.reload();
    //   },
    //   error: (err) => {
    //     console.log(err);
    //   },
    // });
  }
}
