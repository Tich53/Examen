import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ProductfilterComponent } from './productfilter.component';

describe('ProductfilterComponent', () => {
  let component: ProductfilterComponent;
  let fixture: ComponentFixture<ProductfilterComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ProductfilterComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ProductfilterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
