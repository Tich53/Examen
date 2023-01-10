import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ScrapSummaryComponent } from './scrapsummary/scrapsummary.component';
import { TableComponent } from './table/table.component';
import { ChartsComponent } from './charts/charts.component';
import { CompetitorProductComponent } from './competitor-product/competitor-product.component';
import { ProductComponent } from './product/product.component';
import { RegisterComponent } from './_authentication/register/register.component';
import { LoginComponent } from './_authentication/login/login.component';
import { HomeComponent } from './_authentication/home/home.component';
import { ProfileComponent } from './_authentication/profile/profile.component';
import { BoardUserComponent } from './_authentication/board-user/board-user.component';
import { BoardAdminComponent } from './_authentication/board-admin/board-admin.component';
import { AuthGuard } from './_helpers/auth.guard';
import { ProductItemComponent } from './product-item/product-item.component';

const routes: Routes = [
  {
    path: 'tablecomponent',
    component: TableComponent,
  },
  {
    path: 'competitor-product',
    component: CompetitorProductComponent,
  },
  {
    path: 'scrapsummary',
    component: ScrapSummaryComponent,
  },
  { path: 'products', component: ProductComponent },
  { path: 'product-item/id/:id', component: ProductItemComponent },
  { path: 'charts', component: ChartsComponent },
  { path: 'home', component: HomeComponent },
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'profile', component: ProfileComponent },
  { path: 'user', component: BoardUserComponent },
  // verification de authguard.ts, canactivate
  { path: 'admin', component: BoardAdminComponent },
  { path: '', redirectTo: 'home', pathMatch: 'full' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
