import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Post} from '../post';
import {Router} from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class PostService {

  posts;

  constructor(
    private http: HttpClient,
    private router: Router,
  ) { }

  clearPosts() {
    this.posts = '';
    return this.posts;
  }

  fetchPosts() {
    return this.http.get('api/post/list');
  }

  getPosts(search = '') {
    return this.http.get<Post[]>('/api/post/list/' + search)
      .subscribe(
        data => {
          this.posts = data;
          console.log(data);
          this.router.navigate(['/']);
        }
      );
  }

}
