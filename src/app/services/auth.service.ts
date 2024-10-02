import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private apiUrl = 'http://localhost/api'; 
  private currentUserKey = 'currentUser';

  constructor(private http: HttpClient) {}

  login(username: string, password: string): Observable<any> {
    return this.http.post<any>(this.apiUrl, { username, password });
  }

  isLoggedIn(): boolean {
    return !!localStorage.getItem(this.currentUserKey);
  }

  logout(): void {
    localStorage.removeItem(this.currentUserKey);
  }

  getCurrentUser(): any {
    return JSON.parse(localStorage.getItem(this.currentUserKey) || '{}');
  }
}
