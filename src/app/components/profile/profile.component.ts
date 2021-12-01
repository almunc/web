import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Profile } from 'src/app/models/Profile';
import { BackendService } from 'src/app/services/backend.service';
import { User } from 'c:/Users/consult/Documents/THI/3. Semester/Testate/wtp-chat/wtp-chat/src/app/models/User';


@Component({
    selector: 'app-profile',
    templateUrl: './profile.component.html',
    styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
    public userData: any;
    public constructor(private backendService: BackendService, private router: Router) {
        this.userData = {
            firstName: "",
            description: "",
            coffeeOrTea: ""
        };
    }

    public deleteFriend() {
        if(confirm("Are you sure to unfriend Tom?")) {
            this.backendService.removeFriend("Tom").then(res => {
                if (res) {
                    console.log("Friend Tom deleted");
                }
            })
        }
    }

    public ngOnInit(): void {
        this.backendService.loadUser("Tom").then((user: User | null) => {
            console.log(user);
            if (user) {
                this.userData = user;
            }
        })
    }

    public routeTo(route: string) {
        this.router.navigate([route])
    }
}
