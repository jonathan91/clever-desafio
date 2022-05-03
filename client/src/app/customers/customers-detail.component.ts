import { Component, OnInit, OnDestroy } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Subscription } from 'rxjs/Rx';
import { Customers } from './models/customers.model';
import { CustomersService } from './services/customers.service';

@Component({
  selector: 'app-customers-detail',
  templateUrl: './customers-detail.component.html'
})
export class CustomersDetailComponent implements OnInit, OnDestroy {

  customers: Customers;
  private subscription: Subscription;
  
  constructor(
    private customersService: CustomersService,
    private route: ActivatedRoute
  ) {}

  ngOnInit() {
    this.customers = new Customers();
    this.subscription = this.route.params.subscribe((params) => {
      this.load(params['id']);
    });
  }

  load(id: number) {
    this.customersService.find(id).subscribe((customers) => {
      this.customers = customers;
    });
  }

  ngOnDestroy() {
    this.subscription.unsubscribe();
  }
}
