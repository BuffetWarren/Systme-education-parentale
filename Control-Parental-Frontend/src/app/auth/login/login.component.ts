import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/servives/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  acces : any;
  loginForm : FormGroup;
  constructor(
    private authservice : AuthService,
    private formbuilder : FormBuilder,
    private router : Router
  ) { }

  ngOnInit(): void {
    this.initForm();
   /* const data = {
      "email":"louenkamfrank@gmail.com",
      "password":"warren"
    };*/
  }

  /** Permet d'initailiser le formulaire **/
  initForm(){
    this.loginForm = this.formbuilder.group(
      {
        email : ['',[Validators.required,Validators.email]],
        password : ['',[Validators.required]]
      }
    )
  }
  authentification(){
    /** Recupération des données du formulaire via la methode active**/
    const data = this.loginForm.value;
    //console.log(data);
    this.authservice.login(data).subscribe(
      (resp)=>{
          //Si le credentials de l'utilisateur est correct
          this.acces = resp;
          console.log("Connexion reuissie");
          this.router.navigate(['/produits']);
      },
      (error)=>{
          // Sinon on capture l'exception
          console.log("Login ou mot de passe incorrect");
      }
    )
  }
  

}
