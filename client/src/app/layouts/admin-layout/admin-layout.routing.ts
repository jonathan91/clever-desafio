import { Routes } from '@angular/router';

export const AdminLayoutRoutes: Routes = [

    { path: '', loadChildren: '../../customers/customers.module#CustomersModule' },
    /* needle-add-router */
];
