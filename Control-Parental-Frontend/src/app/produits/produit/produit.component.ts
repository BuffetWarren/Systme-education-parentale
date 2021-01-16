import { Component, OnInit } from '@angular/core';
import { from } from 'rxjs';
import { AuthService } from '../../servives/auth.service';
@Component({
  selector: 'app-produit',
  templateUrl: './produit.component.html',
  styleUrls: ['./produit.component.scss']
})
export class ProduitComponent implements OnInit {

  produits : any;
  constructor(
    private authservice: AuthService
  ) { }

  ngOnInit(): void {
    this.liste_produits();
  }

  liste_produits(){
    this.authservice.getProduits().subscribe(
      (resp)=>{
        this.produits = resp;
        //console.log(resp);
      },
      (error)=>{
        console.log(error);
      },
    )
  }

}
