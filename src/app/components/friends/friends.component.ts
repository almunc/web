import { Component, ComponentFactoryResolver, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
    selector: 'app-friends',
    templateUrl: './friends.component.html',
    styleUrls: ['./friends.component.css']
})
export class FriendsComponent implements OnInit {

    public constructor(private router: Router) {
    }

    public ngOnInit(): void {
        this.routeTo("chat");
    }

    public routeTo(route: string) {
        this.router.navigate([route])
    }
}
