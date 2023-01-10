import { ChangeDetectorRef, Component, OnInit } from '@angular/core';
import { SpinnerService } from '../_services/spinner.service'; // import the service

@Component({
  selector: 'app-spinner',
  templateUrl: './spinner.component.html',
  styleUrls: ['./spinner.component.scss']
})
//du tuto https://www.youtube.com/watch?v=H9KLIbisVJ8&ab_channel=CodeWithSrini
//erreur dans vidéos :
//code corrigé voir git hub https://gist.github.com/codewithsrini/2aae47073072b12cd21484aae47b61f9

export class SpinnerComponent implements OnInit {

  showSpinner = false; //define variable and  inject *ngIf to the HTML tag

  constructor(private spinnerService: SpinnerService, private cdRef: ChangeDetectorRef) { //inject spinner class

  }

  ngOnInit(): void {
    this.init();
  }

  init() { // it will listen here and subscribe at the observable
    this.spinnerService.getSpinnerObserver().subscribe ((status) => {
      this.showSpinner = (status === 'start'); //change showSpinner to true
      this.cdRef.detectChanges(); // check the http.interceptor.ts
    });
  }

}
