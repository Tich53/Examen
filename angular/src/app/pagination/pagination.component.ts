import { Component, Input } from '@angular/core';
import { Output, EventEmitter } from '@angular/core';

const FILTER_PAG_REGEX = /[^0-9]/g;

@Component({
  selector: 'app-pagination',
  templateUrl: './pagination.component.html',
  styleUrls: ['./pagination.component.scss'],
})
export class PaginationComponent {
  @Output() currentPage = new EventEmitter<string>();
  @Input() totalItems: number = 0;
  private _page = 1;
  public get page() {
    return this._page;
  }
  public set page(value) {
    this._page = value;
    this.selectPage(value.toString());
  }

  selectPage(page: string) {
    /*     this.page = parseInt(page, 10) || 1; */
    this.currentPage.emit(page);
  }

  formatInput(input: HTMLInputElement) {
    input.value = input.value.replace(FILTER_PAG_REGEX, '');
  }
}
