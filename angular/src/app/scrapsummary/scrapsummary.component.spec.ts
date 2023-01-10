import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ScrapSummaryComponent } from './scrapsummary.component';

describe('ScrapsummaryComponent', () => {
  let component: ScrapSummaryComponent;
  let fixture: ComponentFixture<ScrapSummaryComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ScrapSummaryComponent],
    }).compileComponents();

    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
