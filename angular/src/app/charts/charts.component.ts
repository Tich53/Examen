import { Component, OnInit } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { NgxChartsModule } from '@swimlane/ngx-charts';
import { ApiService } from '../_services/api.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-charts',
  templateUrl: './charts.component.html',
  styleUrls: ['./charts.component.scss'],
})
export class ChartsComponent {
  competitors: any = [];
  historicalPrice: any = [];
  id?: any;
  product?: any;
  competitorProducts?: any = [];

  constructor(private apiService: ApiService, private route: ActivatedRoute) {
    this.route.queryParams.subscribe((params) => {
      this.id = params['id'];
    });
  }

  ngOnInit(): void {
    this.id = this.route.snapshot.paramMap.get('id');
    this.apiService.getProduct(this.id).subscribe((product) => {
      this.product = product;
      this.competitorProducts = this.product.competitorProducts;

      for (let i = 0; i < this.competitorProducts.length; i++) {
        let data: any = {
          name: this.competitorProducts[i]['competitor']['name'],
          series: this.competitorProducts[i][
            'competitorProductPriceHistoricals'
          ].map((competitorProductPriceHistorical: any) => {
            return {
              name: competitorProductPriceHistorical.createdAt,
              value: competitorProductPriceHistorical.price,
            };
          }),
        };
        this.historicalPrice = [...this.historicalPrice, data]; //la nouvelle reference devient la ref actuelle + la nouvelle
      }
    });
  }

  view: [number, number] = [900, 300];

  // options
  legend: boolean = true;
  showLabels: boolean = true;
  animations: boolean = true;
  xAxis: boolean = true;
  yAxis: boolean = true;
  showYAxisLabel: boolean = true;
  showXAxisLabel: boolean = true;
  xAxisLabel: string = 'Year';
  yAxisLabel: string = 'Price';
  timeline: boolean = true;

  colorScheme = {
    domain: ['#5AA454', '#E44D25', '#CFC0BB', '#7aa3e5', '#a8385d', '#aae3f5'],
  };

  onSelect(data: any): void {
    console.log('Item clicked', JSON.parse(JSON.stringify(data)));
  }

  onActivate(data: any): void {
    console.log('Activate', JSON.parse(JSON.stringify(data)));
  }

  onDeactivate(data: any): void {
    console.log('Deactivate', JSON.parse(JSON.stringify(data)));
  }
}
