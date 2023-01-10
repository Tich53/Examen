import { Component, OnInit } from '@angular/core';
import { ApiService } from '../_services/api.service';
import { ActivatedRoute } from '@angular/router';
import { NgbModal, NgbModalConfig } from '@ng-bootstrap/ng-bootstrap';
import { NgForm } from '@angular/forms';
import { Router } from '@angular/router';
import { FilterService } from '../_services/filter.service';

@Component({
  selector: 'app-product-list',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.scss'],
  providers: [NgbModalConfig, NgbModal],
})
export class ProductComponent implements OnInit {
  products: any = [];
  hydraProducts: any = [];
  tags: any = [];
  filteredTags: any = [];
  filteredTagsName: any = [];
  productItemUrl: string = 'http://localhost:4200/product-item/id';
  nbTotalProducts: number = 0;
  page: any = 1;
  cleaned_reference?: string;
  raw_reference?: string;
  cleaned_brand?: string;
  raw_brand?: string;
  name?: string;
  min_price?: number;
  max_price?: number;

  constructor(
    private apiService: ApiService,
    private activatedRoute: ActivatedRoute,
    config: NgbModalConfig,
    private modalService: NgbModal,
    private router: Router,
    private filterService: FilterService
  ) {
    // customize default values of modals used by this component tree
    config.backdrop = 'static';
    config.keyboard = false;
    //subscribe => souscrire a l'observable; data represente les données recup et affiché direct
    this.activatedRoute.queryParamMap.subscribe((params) => {
      // : 1 ; si pas definie page = 1
      const pageString = params.get('page');
      const page = pageString ? parseInt(pageString) : 1;
      const cleaned_referenceString = params.get('cleaned_reference');
      const cleaned_reference = cleaned_referenceString
        ? parseInt(cleaned_referenceString)
        : 0;
      const raw_reference = params.get('raw_reference');
      const cleaned_brand = params.get('cleaned_brand');
      const raw_brand = params.get('raw_brand');
      const name = params.get('name');
      const tags = params.getAll('tags');
      const min_priceString = params.get('min_price');
      const min_price = min_priceString ? parseInt(min_priceString) : 0;
      const max_priceString = params.get('max_price');
      const max_price = max_priceString ? parseInt(max_priceString) : 0;

      this.apiService
        .getProducts(
          page,
          cleaned_reference,
          raw_reference,
          cleaned_brand,
          raw_brand,
          name,
          tags,
          min_price,
          max_price
        )
        .subscribe((product) => {
          this.products = product;
          this.nbTotalProducts = this.products['hydra:totalItems'];
          this.hydraProducts = this.products['hydra:member'];
        });
    });
  }
  open(content: any) {
    this.modalService.open(content);
  }

  ngOnInit(): void {
    this.apiService.getTags().subscribe((tag) => {
      this.tags = tag;
    });
  }
  // need to be included in onSubmit
  OnCheckboxSelect(id: number, name: string, event: any) {
    if (event.target.checked === true) {
      this.filteredTags.push(id);
      this.filteredTagsName.push(name);
    }
    if (event.target.checked === false) {
      const index = this.filteredTags.indexOf(id);
      this.filteredTags.splice(index, 1);
      this.filteredTagsName.splice(index, 1);
    }
  }

  onSubmit(filterForm: NgForm): void {
    this.min_price = filterForm.value.filterData.min_price;
    this.max_price = filterForm.value.filterData.max_price;
    this.cleaned_reference = filterForm.value.filterData.cleaned_reference;
    this.cleaned_brand = filterForm.value.filterData.cleaned_brand;
    this.name = filterForm.value.filterData.name;

    this.router.navigate(['/products'], {
      queryParams: {
        //sucre synthaxique si clef et valeur même nom alors pas besoin de mettre la clef
        //ternaire pour utiliser le queryparams s'il existe sinon undefined
        name: this.name ? this.name : undefined,
        cleaned_reference: this.cleaned_reference
          ? this.cleaned_reference
          : undefined,
        raw_reference: this.raw_reference ? this.raw_reference : undefined,
        cleaned_brand: this.cleaned_brand ? this.cleaned_brand : undefined,
        raw_brand: this.raw_brand ? this.raw_brand : undefined,
        min_price: this.min_price ? this.min_price : undefined,
        max_price: this.max_price ? this.max_price : undefined,
        tags: this.filteredTags ? this.filteredTags : undefined,
      },
    });
  }

  goToProductPage(index: number) {
    this.router.navigate(['/product-item', index]);
  }

  getPageNumber(page: string) {
    this.page = page;
  }

  onPageChange(page: string) {
    this.page = page;
    this.router.navigate(['/products'], {
      queryParams: {
        page: this.page ? this.page : 1,
        cleaned_reference: this.cleaned_reference
          ? this.cleaned_reference
          : undefined,
        cleaned_brand: this.cleaned_brand ? this.cleaned_brand : undefined,
        name: this.name ? this.name : undefined,
        tags: this.filteredTags ? this.filteredTags : undefined,
      },
    });
  }

  nameDelete() {
    this.name = undefined;
    this.filterService.routerNavigateProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_brand,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.name,
      this.filteredTags
    );
  }

  rawRefDelete() {
    this.raw_reference = undefined;
    this.filterService.routerNavigateProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_brand,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.name,
      this.filteredTags
    );
  }

  cleanedRefDelete() {
    this.cleaned_reference = undefined;
    this.filterService.routerNavigateProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_brand,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.name,
      this.filteredTags
    );
  }

  cleanedBrandDelete() {
    this.cleaned_brand = undefined;
    this.filterService.routerNavigateProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_brand,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.name,
      this.filteredTags
    );
  }

  rawBrandDelete() {
    this.raw_brand = undefined;
    this.filterService.routerNavigateProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_brand,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.name,
      this.filteredTags
    );
  }

  minPriceDelete() {
    this.min_price = undefined;
    this.filterService.routerNavigateProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_brand,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.name,
      this.filteredTags
    );
  }

  maxPriceDelete() {
    this.max_price = undefined;
    this.filterService.routerNavigateProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_brand,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.name,
      this.filteredTags
    );
  }

  filteredTagsDelete(competitorName: string) {
    const index = this.filteredTagsName.indexOf(competitorName);
    this.filteredTags.splice(index, 1);
    this.filteredTagsName.splice(index, 1);
    this.filterService.routerNavigateProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_brand,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.name,
      this.filteredTags
    );
  }

  reset() {
    this.name = undefined;
    this.raw_reference = undefined;
    this.cleaned_reference = undefined;
    this.cleaned_brand = undefined;
    this.raw_brand = undefined;
    this.min_price = undefined;
    this.max_price = undefined;
    this.filteredTags.splice(0);
    this.filteredTagsName.splice(0);
  }
}
