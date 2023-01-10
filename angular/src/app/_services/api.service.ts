import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
// import { HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  ProductUrl = 'https://localhost:8000/api/products';

  CompetitorProductUrl = 'https://localhost:8000/api/competitor_products';
  /*   CompetitorProductUrl2 = 'https://localhost:8000/api/competitor_products'; */
  CategoryUrl = 'https://localhost:8000/api/categories.json';
  CompetitorUrl = 'https://localhost:8000/api/competitors.json';
  UserUrl = 'https://localhost:8000/api/me';
  productItemUrl: string = 'https://localhost:8000/api/products';
  TagsUrl = 'https://localhost:8000/api/tags.json';
  logsUrlOscaro = 'https://127.0.0.1:8000/api/scraping_historicals?name=Oscaro';
  logsUrlMisterAuto =
    'https://127.0.0.1:8000/api/scraping_historicals?name=mister-auto';
  constructor(private httpClient: HttpClient) {}

  getProduct(id: any) {
    return this.httpClient.get(this.productItemUrl + '/' + id + '.json');
  }

  getProducts(
    page = 1,
    cleanedReference?: any,
    rawReference?: any,
    cleanedBrand?: any,
    rawBrand?: any,
    productName?: any,
    tags?: any,
    min_price?: number,
    max_price?: number
  ) {
    let params = new HttpParams();
    params = params.set('page', page);
    if (cleanedReference) {
      params = params.set('cleaned_reference', cleanedReference);
    }
    if (rawReference) {
      params = params.set('raw_reference', rawReference);
    }
    if (cleanedBrand) {
      params = params.set('cleaned_brand', cleanedBrand);
    }
    if (rawBrand) {
      params = params.set('raw_brand', rawBrand);
    }
    if (productName) {
      params = params.set('name', productName);
    }
    if (tags) {
      tags.forEach((tag: any) => {
        //tags = affichage dans l'URL
        params = params.append('tags[]', tag);
      });
    }
    if (min_price && max_price) {
      params = params.set('price[between]', min_price + '..' + max_price);
    } else if (min_price) {
      params = params.set('price[gte]', min_price);
    } else if (max_price) {
      params = params.set('price[lte]', max_price);
    }
    return this.httpClient.get(this.ProductUrl + '?' + params);
    // return this.httpClient.get(this.apiUrl);!!!!!!!!!!!!!!!!!!!!!!!!
  }

  getCompetitorProduct(
    page = 1,
    cleanedReference?: any,
    rawReference?: any,
    cleanedBrand?: any,
    rawBrand?: any,
    competitors?: any,
    min_price?: number,
    max_price?: number
  ) {
    let params = new HttpParams();
    params = params.set('page', page);
    if (cleanedReference) {
      params = params.set('cleaned_reference', cleanedReference);
    }
    if (rawReference) {
      params = params.set('raw_reference', rawReference);
    }
    if (cleanedBrand) {
      params = params.set('cleaned_brand', cleanedBrand);
    }
    if (rawBrand) {
      params = params.set('raw_brand', rawBrand);
    }
    if (competitors) {
      competitors.forEach((competitor: any) => {
        params = params.append('competitor[]', competitor);
      });
    }
    if (min_price && max_price) {
      params = params.set('price[between]', min_price + '..' + max_price);
    } else if (min_price) {
      params = params.set('price[gte]', min_price);
    } else if (max_price) {
      params = params.set('price[lte]', max_price);
    }
    return this.httpClient.get(this.CompetitorProductUrl + '?' + params);
  }
  getCategory() {
    return this.httpClient.get(this.CategoryUrl);
  }
  //just in case
  getCompetitor() {
    return this.httpClient.get(this.CompetitorUrl);
  }
  getCurrentUser() {
    return this.httpClient.get(this.UserUrl);
  }
  getTags() {
    return this.httpClient.get(this.TagsUrl);
  }
  getLogsOscaro() {
    return this.httpClient.get(this.logsUrlOscaro);
  }
  getLogsMisterAuto() {
    return this.httpClient.get(this.logsUrlMisterAuto);
  }
}
