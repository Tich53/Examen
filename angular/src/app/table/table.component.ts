import { Component, OnInit } from '@angular/core';
import { ApiService } from '../_services/api.service';

@Component({
  selector: 'app-table',
  templateUrl: './table.component.html',
  styleUrls: ['./table.component.scss'],
})
export class TableComponent implements OnInit {
  products: any = [];

  constructor(private Product: ApiService) {}
  //subscribe => souscrire a l'observable; data represente les données recup et affiché direct
  ngOnInit(): void {
    this.Product.getProducts().subscribe((product) => {
      this.products = product;
      console.log(product);
    });
  }
}
