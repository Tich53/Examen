import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { ApiService } from '../_services/api.service';
import { Router } from '@angular/router';
import { ActivatedRoute } from '@angular/router';
import { NgbModal, NgbModalConfig } from '@ng-bootstrap/ng-bootstrap';
import { FilterService } from '../_services/filter.service';

@Component({
  selector: 'app-competitor-product',
  templateUrl: './competitor-product.component.html',
  styleUrls: ['./competitor-product.component.scss'],
  providers: [NgbModalConfig, NgbModal],
})
export class CompetitorProductComponent implements OnInit {
  competitorProducts: any = [];
  hydraCompetitorProducts: any = [];
  currentUsers: any = [];
  competitors: any = [];
  currentUserCompetitors: any = [];
  filteredCompetitors: any = [];
  filteredCompetitorsNames?: any = [];
  name: any;
  nbTotalProducts: number = 0;

  cleaned_reference?: string;
  raw_reference?: string;
  cleaned_brand?: string;
  raw_brand?: string;
  min_price?: number;
  max_price?: number;
  page: any = 1;

  constructor(
    private apiService: ApiService,
    private activatedRoute: ActivatedRoute,
    config: NgbModalConfig,
    private router: Router,
    private modalService: NgbModal,
    private filterService: FilterService
  ) {
    // customize default values of modals used by this component tree
    config.backdrop = 'static';
    config.keyboard = false;
    //subscribe => souscrire a l'observable; params represente les données recup dans le formulaire
    this.activatedRoute.queryParamMap.subscribe((params) => {
      const pageString = params.get('page');
      const page = pageString ? parseInt(pageString) : 1;
      const cleaned_reference = params.get('cleaned_reference');
      const raw_reference = params.get('raw_reference');
      const cleaned_brand = params.get('cleaned_brand');
      const raw_brand = params.get('raw_brand');
      const competitors = params.getAll('competitors');
      const min_priceString = params.get('min_price');
      const min_price = min_priceString ? parseInt(min_priceString) : 0;
      const max_priceString = params.get('max_price');
      const max_price = max_priceString ? parseInt(max_priceString) : 0;

      // default value set to 0 which is falsy

      //objet competitor product via apiservice methode
      this.apiService
        .getCompetitorProduct(
          page,
          cleaned_reference,
          raw_reference,
          cleaned_brand,
          raw_brand,
          competitors,
          min_price,
          max_price
        )
        .subscribe((competitorProduct) => {
          this.competitorProducts = competitorProduct;
          this.nbTotalProducts = this.competitorProducts['hydra:totalItems'];
          this.hydraCompetitorProducts =
            this.competitorProducts['hydra:member'];
        });
    });
  }

  open(content: any) {
    this.modalService.open(content);
  }

  ngOnInit(): void {
    this.apiService.getCurrentUser().subscribe((currentUser) => {
      this.currentUsers = currentUser;

      Object.keys(this.currentUsers).forEach((key) => {
        this.currentUserCompetitors = this.currentUsers.website.competitor;
      });
    });

    this.apiService.getCompetitor().subscribe((competitor) => {
      this.competitors = competitor;
    });
  }

  rawRefDelete() {
    this.raw_reference = undefined;
    this.filterService.routerNavigateCompetitorProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_reference,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.filteredCompetitors
    );
  }

  cleanedRefDelete() {
    this.cleaned_reference = undefined;
    this.filterService.routerNavigateCompetitorProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_reference,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.filteredCompetitors
    );
  }

  cleanedBrandDelete() {
    this.cleaned_brand = undefined;
    this.filterService.routerNavigateCompetitorProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_reference,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.filteredCompetitors
    );
  }

  rawBrandDelete() {
    this.raw_brand = undefined;
    this.filterService.routerNavigateCompetitorProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_reference,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.filteredCompetitors
    );
  }

  minPriceDelete() {
    this.min_price = undefined;
    this.filterService.routerNavigateCompetitorProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_reference,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.filteredCompetitors
    );
  }

  maxPriceDelete() {
    this.max_price = undefined;
    this.filterService.routerNavigateCompetitorProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_reference,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.filteredCompetitors
    );
  }

  filteredCompetitorDelete(competitorName: string) {
    const index = this.filteredCompetitorsNames.indexOf(competitorName);
    this.filteredCompetitors.splice(index, 1);
    this.filteredCompetitorsNames.splice(index, 1);
    this.filterService.routerNavigateCompetitorProducts(
      this.router,
      this.cleaned_reference,
      this.raw_reference,
      this.cleaned_reference,
      this.raw_brand,
      this.min_price,
      this.max_price,
      this.filteredCompetitors
    );
  }

  // need to be included in onSubmit
  OnCheckboxSelect(id: number, event: any, name: any) {
    if (event.target.checked === true) {
      this.filteredCompetitors.push(id);
      this.filteredCompetitorsNames.push(name);
    }
    if (event.target.checked === false) {
      const index = this.filteredCompetitors.indexOf(id);
      this.filteredCompetitors.splice(index, 1);
      this.filteredCompetitorsNames.splice(index, 1);
    }
  }

  onSubmit(filterForm: NgForm): void {
    this.cleaned_reference = filterForm.value.filterData.cleaned_reference;
    this.raw_reference = filterForm.value.filterData.raw_reference;
    this.cleaned_brand = filterForm.value.filterData.cleaned_brand;
    this.raw_brand = filterForm.value.filterData.raw_brand;
    this.min_price = filterForm.value.filterData.min_price;
    this.max_price = filterForm.value.filterData.max_price;

    this.router.navigate(['/competitor-product'], {
      queryParams: {
        //sucre synthaxique si clef et valeur même nom alors pas besoin de mettre la clef
        //ternaire pour utiliser le queryparams s'il existe sinon undefined
        cleaned_reference: this.cleaned_reference
          ? this.cleaned_reference
          : undefined,
        raw_reference: this.raw_reference ? this.raw_reference : undefined,
        cleaned_brand: this.cleaned_brand ? this.cleaned_brand : undefined,
        raw_brand: this.raw_brand ? this.raw_brand : undefined,
        min_price: this.min_price ? this.min_price : undefined,
        max_price: this.max_price ? this.max_price : undefined,
        competitors: this.filteredCompetitors
          ? this.filteredCompetitors
          : undefined,
      },
    });
  }

  onPageChange(page: string) {
    this.page = page;
    this.router.navigate(['/competitor-product'], {
      queryParams: {
        page: this.page ? this.page : 1,
        cleaned_reference: this.cleaned_reference
          ? this.cleaned_reference
          : undefined,
        cleaned_brand: this.cleaned_brand ? this.cleaned_brand : undefined,
        name: this.name ? this.name : undefined,
        tags: this.filteredCompetitors ? this.filteredCompetitors : undefined,
      },
    });
  }

  reset() {
    this.raw_reference = undefined;
    this.cleaned_reference = undefined;
    this.cleaned_brand = undefined;
    this.raw_brand = undefined;
    this.min_price = undefined;
    this.max_price = undefined;
    this.filteredCompetitors.splice(0);
    this.filteredCompetitorsNames.splice(0);
  }
}
