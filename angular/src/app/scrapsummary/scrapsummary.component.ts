import { Component, OnInit } from '@angular/core';
import { ApiService } from '../_services/api.service';
import { NgbModal, NgbModalConfig } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-scrapsummary',
  templateUrl: './scrapsummary.component.html',
  styleUrls: ['./scrapsummary.component.scss'],
})
export class ScrapSummaryComponent implements OnInit {
  Ok = 'succes';
  Ko = 'error';
  wait = 'in progress';
  scrapValue = 'ScrapValue variable';
  Starttime = 'starttime variable';
  DurationTime = 'durationtime variable';
  TimeRemaining = 'time remaining variable';
  Status = 'status variable';
  Results = 'Results variable';
  lastScrapTimeTopRef = '10:22';
  lastScrapTime = '11:13';

  scrapResult = 'warning';

  nbScrapSuccessTopRef = 12;
  nbScrapErrorTopRef = 35;
  nbScrapSuccessNormalRef = 25;
  nbScrapErrorNormalRef = Math.floor(Math.random() * 1000);

  nbScrapTopRef = Math.floor(Math.random() * 10000);
  nbScrapNormalRef = Math.floor(Math.random() * 10000);

  scrapStatusSuccess = 'success';
  scrapStatusPending = 'warning';
  scrapStatusFailed = 'Danger';

  competitors: any = [];

  logsOscaro: any = [];
  lastScrapDateOscaro: any;
  statusOscaro?: string;
  nbScrappedItemsOscaro?: number;
  statusColorOscaro?: string;

  logsMisterAuto: any = [];
  lastScrapDateMisterAuto: any;
  statusMisterAuto?: string;
  nbScrappedItemsMisterAuto?: number;
  statusColorMisterAuto?: string;

  constructor(private apiService: ApiService) {}

  ngOnInit(): void {
    this.apiService.getCompetitor().subscribe((competitor) => {
      this.competitors = competitor;
    });

    this.apiService.getLogsOscaro().subscribe((log) => {
      this.logsOscaro = log;
      const lastLog =
        this.logsOscaro['hydra:member'][
          this.logsOscaro['hydra:member'].length - 1
        ];
      const scrapData = JSON.parse(lastLog.data);
      this.lastScrapDateOscaro = scrapData.start_time;
      this.nbScrappedItemsOscaro = scrapData.item_scraped_count;
      if (!this.nbScrappedItemsOscaro) {
        this.statusOscaro = 'Failed';
        this.statusColorOscaro = 'danger';
      } else {
        this.statusOscaro = 'Success';
        this.statusColorOscaro = 'success';
      }
    });

    this.apiService.getLogsMisterAuto().subscribe((log) => {
      this.logsMisterAuto = log;
      const lastLog =
        this.logsMisterAuto['hydra:member'][
          this.logsMisterAuto['hydra:member'].length - 1
        ];
      const scrapData = JSON.parse(lastLog.data);
      this.lastScrapDateMisterAuto = scrapData.start_time;
      this.nbScrappedItemsMisterAuto = scrapData.item_scraped_count;
      if (!this.nbScrappedItemsMisterAuto) {
        this.statusMisterAuto = 'Failed';
        this.statusColorMisterAuto = 'danger';
      } else {
        this.statusMisterAuto = 'Success';
        this.statusColorMisterAuto = 'success';
      }
    });
  }
}
