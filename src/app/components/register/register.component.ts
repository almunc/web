import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { BackendService } from 'src/app/services/backend.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
})
export class RegisterComponent implements OnInit {
  public username: string = '';
  public password: string = '';
  public confirm: string = '';
  public usernameOk: boolean = false;
  public passwordOk: boolean = false;
  public userExist: boolean = false;
  

  public constructor(private backendService: BackendService, private router: Router) {}

  public ngOnInit(): void {}

  public userExists(): void {
    this.backendService.userExists(this.username).then(result=> {
      this.userExist = result;
      if(this.userExist=result) {
        this.usernameOk = false;
      } else {
        this.usernameOk = true;
      }
    })
  }

  public checkUsername(): void {
    if (this.username.length < 3) {
      this.usernameOk = false;
    } else {
      this.usernameOk = true;
    }
  }

  public checkPassword(): void {
    if (this.password.length < 8) {
      this.passwordOk = false;
    } else {
      this.passwordOk = true;
    }
  }

  public checkConfirm(): void {
    if (this.password != this.confirm) {
      this.passwordOk = false;
    } else {
      this.passwordOk = true;
    }
  }

  //submit or not
  public createAccount(): void {
    this.checkUsername();
    this.checkPassword();
    this.checkConfirm();
    this.userExists();
  }


  public registerUser(): void {
    //this.createAccount();
    //if(this.passwordOk == true && this.usernameOk == true) {
    this.backendService.register(this.username, this.password);
    this.router.navigate(["/friends"]);
    //}
  }

}
