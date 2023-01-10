import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CompetitorProductComponent } from './competitor-product.component';

describe('CompetitorProductComponent', () => {
  let component: CompetitorProductComponent;
  let fixture: ComponentFixture<CompetitorProductComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CompetitorProductComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CompetitorProductComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
