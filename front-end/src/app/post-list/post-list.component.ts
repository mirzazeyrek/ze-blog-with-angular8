import {Component, Injectable, OnInit} from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { PostService } from '../post.service';

@Component({
  selector: 'app-post-list',
  templateUrl: './post-list.component.html',
  styleUrls: ['./post-list.component.css']
})
export class PostListComponent implements OnInit {
  response;
  posts = [];
  constructor(
    private http: HttpClient,
    private postService: PostService
  ) { }

  ngOnInit() {
    this.getResponse();
    this.response = this.postService.posts;
  }

  getResponse(search = '') {
    this.postService.getPosts(search);
    /*return this.http.get<Post[]>('/api/post/list/' + search)
      .subscribe(
      data => {
        this.response = data;
        console.log(data);
      }
    );*/
  }

  delete(post, index) {
   this.http.delete<void>('/api/post/delete/' + post.id)
      .subscribe(
        data  => {
          console.log('POST Request is successful ', data);
          this.response.posts.splice(index, 1);
        },
        error  => {

          console.log('Error', error);
          console.log(post);
          console.log(index);
          console.log(this.response);
        });
   window.alert('The post will be deleted!.');
  }
}
