import { Component, OnInit } from '@angular/core';
import { PostService } from '../post.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-top-bar',
  templateUrl: './top-bar.component.html',
  styleUrls: ['./top-bar.component.css']
})
export class TopBarComponent implements OnInit {
  searchValue: any;

  constructor(
    private router: Router,
    private postService: PostService
  ) {}

  ngOnInit() {
  }

  search(searchValue: any) {
    this.postService.getPosts(searchValue);
  }
}


/*
Copyright Google LLC. All Rights Reserved.
Use of this source code is governed by an MIT-style license that
can be found in the LICENSE file at http://angular.io/license
*/
