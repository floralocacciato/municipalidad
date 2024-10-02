import { Component } from '@angular/core';
import { FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { FormBuilder, Validators } from '@angular/forms';
import { DatabaseService } from 'src/app/services/database.service';
@Component({
  selector: 'app-inciosesion',
  templateUrl: './inciosesion.component.html',
  styleUrls: ['./inciosesion.component.css']
})
export class InciosesionComponent {
  hide: boolean = true; // Para ocultar/mostrar la contraseña
  loginForm: FormGroup;
  errorMessage: string = '';
  currentUserKey: string = 'currentUser'; // Define la clave para localStorage

  constructor(
    private fb: FormBuilder,
    private databaseService: DatabaseService,
    private router: Router
  ) {
    this.loginForm = this.fb.group({
      email: ['', Validators.required],
      pass: ['', Validators.required]
    });
  }

  onSubmit() {
    if (this.loginForm.valid) {
      const { email, pass } = this.loginForm.value;

      this.databaseService.login(email, pass).subscribe(
        response => {
          if (response.resultado === 'OK') {
            // Guardamos el usuario en localStorage
            localStorage.setItem(this.currentUserKey, JSON.stringify(response.usuario));
            this.router.navigate(['/usuarios']);
          } else {
            this.errorMessage = response.mensaje;
          }
        },
        error => {
          this.errorMessage = 'Error en la autenticación';
        }
      );
    }
  }
}
