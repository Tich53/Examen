import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../_services/auth.service';
import { StorageService } from '../../_services/storage.service';
import { ApiService } from '../../_services/api.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss'],
})
export class ProfileComponent implements OnInit {
  currentUser: any;
  private roles: string[] = [];
  isLoggedIn = false;
  showAdminBoard = false;
  showModeratorBoard = false;
  email?: string;
  users?: any = [];
  role?:any=[];

  constructor(
  private storageService: StorageService,
  private authService: AuthService,
  private apiService: ApiService) {}

  ngOnInit(): void {
    this.currentUser = this.storageService.getUser();
    this.isLoggedIn = this.storageService.isLoggedIn();
    console.log(this.isLoggedIn);

    if (this.isLoggedIn) {
      this.apiService.getCurrentUser().subscribe((user) => {
        this.users = user;

        this.email = this.users.email;
        this.role = this.users.roles;
        console.log(this.email);
        console.log(this.role);
      });

      /*      this.roles = user.roles;

      this.showAdminBoard = this.roles.includes('ROLE_ADMIN');
      this.showModeratorBoard = this.roles.includes('ROLE_MODERATOR');

      this.email = user.email; */
    }
  }
  }

