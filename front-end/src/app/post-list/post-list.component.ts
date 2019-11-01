import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Post } from '../../post';

@Component({
  selector: 'app-post-list',
  templateUrl: './post-list.component.html',
  styleUrls: ['./post-list.component.css']
})
export class PostListComponent implements OnInit {
  response;
  posts = [];
  constructor(
    private http: HttpClient
  ) { }

  ngOnInit() {
    this.response = this.getResponse();
  }

  getResponse() {
    return this.http.get<Post[]>('/api/post/list');
  }

  edit(post) {
    window.alert('The post will be edited!');
  }

  delete(post, index) {
   this.http.delete('/api/post/delete/' + post.id)
      .subscribe(
        data  => {
          console.log('POST Request is successful ', data);
        },
        error  => {

          console.log('Error', error);
          console.log(post);
          console.log(index);
          console.log(this.response);
          this.response.filter(post, index);
        });
   window.alert('The post will be deleted!.');
  }
}
