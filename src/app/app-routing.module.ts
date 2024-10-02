import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { InciosesionComponent } from './components/inciosesion/inciosesion.component';
import { UsuariosComponent } from './components/usuarios/usuarios.component';

const routes: Routes = [
  { path: 'inicio', component: InciosesionComponent },
  { path: 'usuarios', component: UsuariosComponent }

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
