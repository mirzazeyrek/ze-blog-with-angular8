import {Component, Injectable, OnInit} from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { PostService } from '../post.service';

@Component({
  selector: 'app-post-list',
  templateUrl: './post-list.component.html',
  styleUrls: ['./post-list.component.css']
})
export class PostListComponent implements OnInit {

  posts = [];
  constructor(
    private http: HttpClient,
    private postService: PostService
  ) { }

  ngOnInit() {
    this.getResponse();
  }

  public getResponse(search = ''): void {
    this.postService.getPosts(search);
  }

  public delete(post, index): void {
   this.http.delete<void>('/api/post/delete/' + post.id)
      .subscribe(
        data  => {
          console.log('POST Request is successful ', data);
          this.postService.posts.splice(index, 1);
        },
        error  => {
          console.log('Error', error);
          console.log(post);
          console.log(index);
        });
   window.alert('The post will be deleted!.');
  }
}
