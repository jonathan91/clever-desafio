import { Routes } from '@angular/router';
import { CustomersComponent } from './customers.component';
import { CustomersDetailComponent } from './customers-detail.component';
import { CustomersFormComponent } from './customers-form.component';

export const customersRoute: Routes = [
  {
    path: '',
    component: CustomersComponent
  },
  {
    path: 'new',
    component: CustomersFormComponent
  },
  {
    path: ':id/edit',
    component: CustomersFormComponent
  },
  {
    path: ':id',
    component: CustomersDetailComponent
  },
];
