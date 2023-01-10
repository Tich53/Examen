import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ApiService } from '../_services/api.service';

@Component({
  selector: 'app-product-item',
  templateUrl: './product-item.component.html',
  styleUrls: ['./product-item.component.scss'],
})
export class ProductItemComponent implements OnInit {
  id?: any;
  product?: any;
  rawReference?: string;
  rawBrand?: string;
  productName?: string;
  productPrice?: number;
  competitorProducts: any = [];
  competitorName?: string;
  competitors: any = [];
  competitorProductPrice?: number;
  competitorProductPriceHistoricals?: any = [];

  constructor(private apiService: ApiService, private route: ActivatedRoute) {
    this.route.queryParams.subscribe((params) => {
      this.id = params['id'];
    });
  }

  ngOnInit(): void {
    this.id = this.route.snapshot.paramMap.get('id');
    this.apiService.getProduct(this.id).subscribe((product) => {
      this.product = product;
      this.rawBrand = this.product.raw_brand;
      this.rawReference = this.product.raw_reference;
      this.productName = this.product.name;
      this.productPrice = this.product.price;
      this.competitorProducts = this.product.competitorProducts;
      this.competitorProductPriceHistoricals =
        this.product.competitorProducts.competitorProductPriceHistoricals;

      Object.keys(this.competitorProducts).forEach((key) => {
        this.competitorProductPriceHistoricals =
          this.competitorProducts.competitorProductPriceHistoricals;
      });
    });
  }
}
