import { Component, OnInit, OnDestroy } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Observable, Subscription } from 'rxjs/Rx';
import { NotificationService } from 'app/shared/services/notification.service';
import { Customers } from './models/customers.model';
import { CustomersService } from './services/customers.service';


interface Coutry {
  value: string;
  viewValue: string;
}


@Component({
  selector: 'app-customers-form',
  templateUrl: './customers-form.component.html'
})
export class CustomersFormComponent implements OnInit, OnDestroy {
  customers: Customers;
  isSaving: boolean;
  isEdit = false;
  iso = "";
  
  coutries: Coutry[] = [
    {value: 'CM', viewValue: 'Cameroon'},
    {value: 'ET', viewValue: 'Ethiopia'},
    {value: 'MA', viewValue: 'Morocco'},
    {value: 'MZ', viewValue: 'Mozambique'},
    {value: 'UG', viewValue: 'Uganda'},
  ];

  private routeSub: Subscription;


  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private notification: NotificationService,
    private customersService: CustomersService,
  ) {}

  ngOnInit() {
    this.isSaving = false;
    this.routeSub = this.route.params.subscribe(params => {
      let title = 'Create';
      this.customers = new Customers();
      if (params['id']) {
        this.isEdit = true;
        this.customersService.find(params['id']).subscribe(customers => {
          this.customers = customers
          this.iso = customers.iso
        });
        title = 'Edit';
      }
    });
  }

  save() {
    this.isSaving = true;
    if (this.customers.id !== undefined) {
      this.subscribeToSaveResponse(this.customersService.update(this.customers));
    } else {
      this.customers.iso = this.iso;
      this.subscribeToSaveResponse(this.customersService.create(this.customers));
    }
  }

  private subscribeToSaveResponse(result: Observable<Customers>) {
    result.subscribe(
      (customers: Customers) => {
      this.isSaving = false;
      this.router.navigate(['/customers']);
      this.notification.showNotification(this.notification.msgSuccess, 'success');
    },
    (response: {error?: any}) => {
      this.notification.showNotification(response.error.detail, 'warning');
      this.isSaving = false;
    });
  }

  ngOnDestroy() {
    this.routeSub.unsubscribe();
  }
}
