import { Component, OnInit } from '@angular/core';
import { AfterViewChecked, ElementRef, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { ContextService } from 'src/app/services/context.service';
import { IntervalService } from 'src/app/services/interval.service';
import { BackendService } from '../../services/backend.service';


@Component({
  selector: 'app-chat',
  templateUrl: './chat.component.html',
  styleUrls: ['./chat.component.css']
})

export class ChatComponent implements OnInit, AfterViewChecked {
    [x: string]: any;
    // DIV für Nachrichten (s. Template) als Kind-Element für Aufrufe (s. scrollToBottom()) nutzen
    @ViewChild('messagesDiv') private myScrollContainer: ElementRef;

    public constructor(private backendService: BackendService, private intervalService: IntervalService, private router: Router, public context: ContextService) { 
        this.myScrollContainer = new ElementRef(null);
    }

    public ngAfterViewChecked() {        
        this.scrollToBottom();
    } 

    /**
     * Setzt in der Nachrichtenliste die Scrollposition ("scrollTop") auf die DIV-Größe ("scrollHeight"). Dies bewirkt ein 
     * Scrollen ans Ende.
     */
    private scrollToBottom(): void {
        try {
            this.myScrollContainer.nativeElement.scrollTop = this.myScrollContainer.nativeElement.scrollHeight;
        } catch(err) { 
        }                 
    }

    public sendMsg() {
        console.log(this.msg);
        this.backendService.sendMessage(this.context.currentChatUsername, this.msg);
        this.msg = "";
    }

    public deleteFriend() {
        if(confirm("Are you sure to unfriend " + this.context.currentChatUsername +"?")) {
            this.backendService.removeFriend(this.context.currentChatUsername).then(res => {
                if (res) {
                    console.log("Friend " + this.context.currentChatUsername + " deleted");
                }
            })
        }
    }

    public ngOnInit(): void {
        this.scrollToBottom();

        this.intervalService.setInterval("ChatComponent", () => {
            this.backendService.listMessages(this.context.currentChatUsername).then(msgs => {
                this.msgs = msgs;
                console.log(this.msgs);
            })
        })
    }

    public routeTo(route: string) {
        this.intervalService.clearIntervals();
        this.router.navigate([route])
    }
}
