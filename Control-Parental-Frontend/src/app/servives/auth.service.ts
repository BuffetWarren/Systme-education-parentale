import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
@Injectable({
  providedIn: 'root'
})
export class AuthService {

  public serveur : string = "http://localhost:8000/api/";
  constructor(
    private http : HttpClient
  ) { }

  login(data){
    return this.http.post(this.serveur+"auth/login",data);
  }

  signup(data){
    return this.http.post(this.serveur+"auth/signup",data);
  }
  
  getProduits(){
    return this.http.get(this.serveur+"produits");
  }
}
