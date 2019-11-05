import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ActivatedRoute } from '@angular/router';
import {products} from '../products';

@Component({
  selector: 'app-post-details',
  templateUrl: './post-details.component.html',
  styleUrls: ['./post-details.component.css']
})
export class PostDetailsComponent implements OnInit {
  post;
  constructor(
    private route: ActivatedRoute,
    private http: HttpClient
  ) { }

  ngOnInit() {
    this.getPostDetails();
  }

  share(postId) {
    alert('it is shared! ' + postId);
  }

  getPostDetails() {
    this.route.paramMap.subscribe(params => {
      this.post = this.http.get('api/post/detail/' + params.get('postId') );
    });
  }
}
