import { Component, ComponentFactoryResolver, OnInit } from '@angular/core';
import { Router, UrlSerializer } from '@angular/router';
import { Friend } from 'src/app/models/Friend';
import { User } from 'src/app/models/User';
import { BackendService } from 'src/app/services/backend.service';
import { ContextService } from 'src/app/services/context.service';
import { IntervalService } from 'src/app/services/interval.service';

@Component({
    selector: 'app-friends',
    templateUrl: './friends.component.html',
    styleUrls: ['./friends.component.css']
})
export class FriendsComponent implements OnInit {

    public friendsPuffer: Array<Friend> = new Array
    public friendsAddedPuffer: Array<Friend> = new Array
    public friendsAdded: Array<Friend> = new Array
    public friendsRequestPuffer: Array<Friend> = new Array
    public friendsRequest: Array<Friend> = new Array
    public currentUser: User = new User()
    public newFriend: string = ""
    public unreadMessages: Map<string, number> = new Map

    public constructor(
        private backendservice: BackendService,
        private router: Router,
        private intervalService: IntervalService,
        private context: ContextService
    ) { }

    public ngOnInit(): void {
        this.intervalService.setInterval("FriendsComponent", () => {
            this.backendservice.loadCurrentUser().then((user: User | null) => {
                if(user){
                    console.log(user)
                    this.currentUser = user
                    console.log(this.currentUser)
                } else {
                    console.log("Fehler")
                }
            })
            this.backendservice.loadFriends().then(res =>
                this.friendsPuffer = res
                )
            console.log(this.friendsPuffer)
            this.setUnreadMessages()
        })
        
    }

    setUnreadMessages(){
        this.friendsAddedPuffer = new Array
        this.friendsRequestPuffer = new Array
        this.backendservice.unreadMessageCounts().then(res =>{
            this.unreadMessages = res
                console.log(res)
        })
        for(let i = 0; i < this.friendsPuffer.length; i++){
            this.friendsPuffer[i].unreadMessages = this.unreadMessages.get(this.friendsPuffer[i].username) as number
            
            if(this.friendsPuffer[i].unreadMessages == undefined){
                this.friendsPuffer[i].unreadMessages = 0
            }

            console.log(this.friendsPuffer[i].unreadMessages)

            if(this.friendsPuffer[i].status == "accepted"){
                this.friendsAddedPuffer.push(this.friendsPuffer[i])
            } else{
                this.friendsRequestPuffer.push(this.friendsPuffer[i])
            }
        }
        this.friendsAdded = this.friendsAddedPuffer
        this.friendsRequest = this.friendsRequestPuffer
    }

    acceptRequest(username: string){
        this.backendservice.acceptFriendRequest(username)
        this.backendservice.loadFriends().then(res =>
            this.friendsPuffer = res
            )
        console.log(this.friendsPuffer)
        this.setUnreadMessages()
    }

    declineRequest(username: string){
        this.backendservice.dismissFriendRequest(username)
        this.backendservice.loadFriends().then(res =>
            this.friendsPuffer = res
            )
        console.log(this.friendsPuffer)
        this.setUnreadMessages()
    }

    addFriend(){
        let bool = this.backendservice.friendRequest(this.newFriend).then(res =>
                console.log(res)
            )
        console.log(this.newFriend)
    }

    public routeTo(route: string, friend?: string) {
        this.intervalService.clearIntervals();
        if(friend) {
            this.context.currentChatUsername = friend;
        }
        this.router.navigate([route])
    }
}
