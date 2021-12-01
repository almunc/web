import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { BackendService } from 'src/app/services/backend.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
})
export class LoginComponent implements OnInit {
  public username: string = '';
  public password: string = '';
  public failed: boolean = false;
  

  public constructor(private backendService: BackendService, private router: Router) {}

  public performAuthentification(): void {
    this.backendService.login(this.username, this.password).then(result=> {
      //console.log(result);
      if(result) {
        this.router.navigate(["/friends"]);
      } else {
        this.failed = true;
      }
    })
  }

  public routeTo(route: string) {
    this.router.navigate([route])
  }

  public ngOnInit(): void {}
}
