import { Component, OnInit, OnDestroy, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { MatDialog } from '@angular/material';
import { DialogContent } from 'app/shared/dialog/dialog-content.component';
import { NotificationService } from 'app/shared/services/notification.service';
import { CardComponent } from 'app/shared/card/card.component';
import { CustomersService } from './services/customers.service';
import { Customers } from './models/customers.model';
import { HttpParams } from '@angular/common/http';

interface Select {
  value: string;
  viewValue: string;
}

@Component({
  selector: 'app-customers',
  templateUrl: './customers.component.html'
})
export class CustomersComponent implements OnInit, OnDestroy {

  @ViewChild(CardComponent)
  card: CardComponent;

  searchUrl: string = this.customersService.resourceUrl;
  st = "";
  coutry = "";

  coutries: Select[] = [
    {value: 'CM', viewValue: 'Cameroon'},
    {value: 'ET', viewValue: 'Ethiopia'},
    {value: 'MA', viewValue: 'Morocco'},
    {value: 'MZ', viewValue: 'Mozambique'},
    {value: 'UG', viewValue: 'Uganda'},
  ];

  status: Select[] = [
    {value: 'VALID', viewValue: 'Valid'},
    {value: 'INVALID', viewValue: 'Invalid'},
  ];

  constructor(
    private router: Router,
    private customersService: CustomersService,
    public dialog: MatDialog,
    private notification: NotificationService
  ) {}

  click(event: any) {
    this.card.click.subscribe(result =>{
    if (result.button === 'view') 
      this.view(result.row);

    if (result.button === 'edit') 
      this.edit(result.row);
    
    if (result.button === 'delete') 
      this.delete(result.row);
    });
  }

  view(customers: Customers) {
    this.router.navigate([`/customers/${customers.id}`]);
  }

  edit(customers: Customers) {
   this.router.navigate([`/customers/${customers.id}/edit`]);
  }

  delete(customers: Customers) {
    this.dialog.open(DialogContent).beforeClose().subscribe(
      res => {
        if(res){
          this.customersService.delete(customers.id).subscribe(
            response => {
              this.card.ngOnInit();
              this.notification.showNotification(this.notification.msgSuccess, 'success');
            },
            error => {
              this.notification.showNotification(error.message, 'danger');
            });
        }
      }
    );
  }

  search() {
    let params = new HttpParams();
    params = params.append('status', this.st);
    params = params.append('iso', this.coutry);
    this.card.search(params);
  }

  ngOnInit() {
  }

  ngOnDestroy() {
  }

}