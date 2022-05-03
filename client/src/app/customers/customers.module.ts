import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpModule } from '@angular/http';
import { RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CardModule } from '../shared/card/card.module';
import {
    MatButtonModule,
    MatInputModule,
    MatRippleModule,
    MatFormFieldModule,
    MatTooltipModule,
    MatSelectModule,
    MatDialogModule,
} from '@angular/material';

import { CustomersFormComponent } from './customers-form.component';
import { CustomersDetailComponent } from './customers-detail.component';
import { CustomersComponent } from './customers.component';
import { customersRoute } from './customers.route';
import { CustomersService } from './services/customers.service';

@NgModule({
  imports: [
    CommonModule,
    HttpModule,
    FormsModule,
    CardModule,
    RouterModule.forChild(customersRoute),
    MatButtonModule,
    MatInputModule,
    MatRippleModule,
    MatFormFieldModule,
    MatTooltipModule,
    MatSelectModule,
    MatDialogModule,
  ],
  declarations: [
    CustomersComponent,
    CustomersDetailComponent,
    CustomersFormComponent
  ],
  providers: [CustomersService],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class CustomersModule {}
