import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/Rx';
import { environment } from 'environments/environment';
import { Customers } from '../models/customers.model';

@Injectable()
export class CustomersService {

  resourceUrl = environment.apiUrl + '/customers';

  constructor(private http: HttpClient) { }

  create(customers: Customers): Observable<Customers> {
    return this.http.post<Customers>(this.resourceUrl, customers);
  }

  update(customers: Customers): Observable<Customers> {
    return this.http.put<Customers>(`${this.resourceUrl}/${customers.id}`, customers);
  }

  find(id: number): Observable<Customers> {
    return this.http.get<Customers>(`${this.resourceUrl}/${id}`);
  }

  query(req?: any): Observable<Customers[]> {
    return this.http.get<Customers[]>(this.resourceUrl, { params: req });
  }
  
  delete(id: number) {
    return this.http.delete(`${this.resourceUrl}/${id}`);
  }
}
