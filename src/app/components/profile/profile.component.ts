import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Profile } from 'src/app/models/Profile';
import { BackendService } from 'src/app/services/backend.service';
import { User } from 'src/app/models/User';
import { ContextService } from 'src/app/services/context.service';


@Component({
    selector: 'app-profile',
    templateUrl: './profile.component.html',
    styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
    public userData: any;
    public constructor(private backendService: BackendService, private router: Router, public context: ContextService) {
        this.userData = {
            firstName: "",
            description: "",
            coffeeOrTea: ""
        };
    }

    public deleteFriend() {
        if(confirm("Are you sure to unfriend "+ this.context.currentChatUsername +"?")) {
            this.backendService.removeFriend(this.context.currentChatUsername).then(res => {
                if (res) {
                    console.log("Friend " + this.context.currentChatUsername + " deleted");
                }
            })
        }
    }

    public ngOnInit(): void {
        this.backendService.loadUser(this.context.currentChatUsername).then((user: User | null) => {
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
