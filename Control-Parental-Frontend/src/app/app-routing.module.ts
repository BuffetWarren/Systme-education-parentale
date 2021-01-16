import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './auth/login/login.component';
import { Page404Component } from './page404/page404.component';
import { ProduitComponent } from './produits/produit/produit.component';

const routes: Routes = [
  {path:'', component: LoginComponent},
  {path:'produits', component: ProduitComponent},
  {path:'login', component: LoginComponent},
  {path:'not-found', component: Page404Component},
  {path:'**', redirectTo: '/not-found'}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
