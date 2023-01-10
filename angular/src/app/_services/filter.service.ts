import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class FilterService {
  constructor() {}

  routerNavigateCompetitorProducts(
    router: any,
    cleanedRef?: string,
    raw_reference?: string,
    cleanedBrand?: string,
    rawBrand?: string,
    minPrice?: number,
    maxPrice?: number,
    filteredCompetitors?: any
  ) {
    router.navigate(['/competitor-product'], {
      queryParams: {
        //sucre synthaxique si clef et valeur même nom alors pas besoin de mettre la clef
        //ternaire pour utiliser le queryparams s'il existe sinon undefined
        cleaned_reference: cleanedRef ? cleanedRef : undefined,
        raw_reference: raw_reference ? raw_reference : undefined,
        cleaned_brand: cleanedBrand ? cleanedBrand : undefined,
        raw_brand: rawBrand ? rawBrand : undefined,
        min_price: minPrice ? minPrice : undefined,
        max_price: maxPrice ? maxPrice : undefined,
        competitors: filteredCompetitors ? filteredCompetitors : undefined,
      },
    });
  }

  routerNavigateProducts(
    router: any,
    cleanedRef?: string,
    raw_reference?: string,
    cleanedBrand?: string,
    rawBrand?: string,
    minPrice?: number,
    maxPrice?: number,
    name?: string,
    filteredTags?: any
  ) {
    router.navigate(['/products'], {
      queryParams: {
        //sucre synthaxique si clef et valeur même nom alors pas besoin de mettre la clef
        //ternaire pour utiliser le queryparams s'il existe sinon undefined
        name: name ? name : undefined,
        cleaned_reference: cleanedRef ? cleanedRef : undefined,
        raw_reference: raw_reference ? raw_reference : undefined,
        cleaned_brand: cleanedBrand ? cleanedBrand : undefined,
        raw_brand: rawBrand ? rawBrand : undefined,
        min_price: minPrice ? minPrice : undefined,
        max_price: maxPrice ? maxPrice : undefined,
        tags: filteredTags ? filteredTags : undefined,
      },
    });
  }
}
