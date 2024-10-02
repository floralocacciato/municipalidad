import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class DatabaseService {

  private apiUrl = 'http://localhost/api-php/public/index.php';
  private currentUserKey = 'currentUser';
  constructor(private http: HttpClient) { }


  alta(usuarioData: any): Observable<any> {
    return this.http.post(`${this.apiUrl}`, usuarioData);
  }

  recuperar(): Observable<any> {
    return this.http.get(`${this.apiUrl}`);
  }

  baja(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}?id=${id}`);
  }
  
  // Nuevo método para modificar un usuario
  modificar(usuario: any): Observable<any> {
    return this.http.put(`${this.apiUrl}`, usuario);
  }
  login(email: string, pass: string): Observable<any> {
    return this.http.post<any>(this.apiUrl, { email, pass });
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
