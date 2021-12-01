import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Profile } from 'src/app/models/Profile';
import { User } from 'src/app/models/User';
import { BackendService } from 'src/app/services/backend.service';
import { IntervalService } from 'src/app/services/interval.service';


@Component({
    selector: 'app-settings',
    templateUrl: './settings.component.html',
    styleUrls: ['./settings.component.css']
})
export class SettingsComponent implements OnInit {
    public firstName: string = ""
    public lastName: string = ""
    public coffeeOrTea: number = 1
    public description: string = ""
    public layout: number = 1
    public user: User = new User()
    
    public constructor(
        private backendservice: BackendService,
        private router: Router,
        private intervalService: IntervalService,
    ) {
    }

    public ngOnInit(): void {
        this.backendservice.loadCurrentUser().then( (user: User | null) => {
            if(user){
                console.log(user)
                this.user = user
                console.log(this.user)
            } else {
                console.log("Fehler")
            }
        })
        if(this.user.profil){
            this.firstName = this.user.profil.firstName
            console.log(this.user.profil.firstName)
            this.lastName = this.user.profil.lastName
            this.description = this.user.profil.description
            switch (this.user.profil.coffeeOrTea) {
                case "Neither nor":
                    this.coffeeOrTea = 1
                    break;
            
                case "Coffee":
                    this.coffeeOrTea = 2
                    break;

                case "Tea":
                    this.coffeeOrTea = 3
                    break;

                default:
                    break;
            }
            if(this.user.profil.layout == "oneLine"){
                this.layout = 1
            } else {
                this.layout = 2
            }
        }
    }

    saveSetting(){
        var coffeeOrTeaString = ""
        var layoutString = ""

        switch (this.coffeeOrTea) {
            case 1:
                coffeeOrTeaString = "Neither nor"
                break;

            case 2:
                coffeeOrTeaString = "Coffee"
                break;
        
            case 3:
                coffeeOrTeaString = "Tea"
                break;
        }

        if(this.layout == 1){
            layoutString = "oneLine"
        } else {
            layoutString = "twoLines"
        }

        let profile = new Profile(this.firstName, this.lastName, coffeeOrTeaString, this.description, layoutString)
        this.backendservice.saveCurrentUserProfile(profile)
        this.routeTo('friends')
    }

    public routeTo(route: string) {
        this.router.navigate([route])
    }
}
