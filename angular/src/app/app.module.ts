import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { NgxChartsModule } from '@swimlane/ngx-charts';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { HeaderComponent } from './shared/header/header.component';
import { SidebarComponent } from './shared/sidebar/sidebar.component';
import { BreadcrumbComponent } from './shared/breadcrumb/breadcrumb.component';
import { ChartsComponent } from './charts/charts.component';
import { TableComponent } from './table/table.component';
import { FooterComponent } from './shared/footer/footer.component';
import { ProductComponent } from './product/product.component';

import { CompetitorProductComponent } from './competitor-product/competitor-product.component';
import { ScrapSummaryComponent } from './scrapsummary/scrapsummary.component';
import { LoginComponent } from './_authentication/login/login.component';
import { RegisterComponent } from './_authentication/register/register.component';
import { HomeComponent } from './_authentication/home/home.component';
import { ProfileComponent } from './_authentication/profile/profile.component';
import { BoardAdminComponent } from './_authentication/board-admin/board-admin.component';
import { BoardUserComponent } from './_authentication/board-user/board-user.component';
import { HttpInterceptorProviders } from './_helpers/http.interceptor';
import { ProductfilterComponent } from './productfilter/productfilter.component';
import { SpinnerComponent } from './spinner/spinner.component';
import { ProductItemComponent } from './product-item/product-item.component';
import { PaginationComponent } from './pagination/pagination.component';


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    SidebarComponent,
    BreadcrumbComponent,
    ChartsComponent,
    TableComponent,
    ScrapSummaryComponent,
    FooterComponent,
    ProductComponent,
    CompetitorProductComponent,
    LoginComponent,
    RegisterComponent,
    HomeComponent,
    ProfileComponent,
    BoardAdminComponent,
    BoardUserComponent,
    ScrapSummaryComponent,
    LoginComponent,
    RegisterComponent,
    HomeComponent,
    ProfileComponent,
    BoardAdminComponent,
    BoardUserComponent,
    ProductfilterComponent,
    SpinnerComponent,
    ProductItemComponent,
    PaginationComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    HttpClientModule,
    FormsModule,
    NgxChartsModule,
    BrowserAnimationsModule,
  ],
  providers: [HttpInterceptorProviders],
  bootstrap: [AppComponent],
})
export class AppModule {}
