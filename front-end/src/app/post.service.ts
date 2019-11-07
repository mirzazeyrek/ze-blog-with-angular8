import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Post, PostListResponse} from '../post';
import {Router} from '@angular/router';
import {Observable, Subscription} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PostService {

  public posts: Post[] = [];

  constructor(
    private http: HttpClient,
    private router: Router,
  ) { }

  public getPosts(search: string = ''): Subscription {
    return this.http
      .get('/api/post/list/' + search)
      .subscribe(
        (data: PostListResponse) => {
          this.posts = data.posts;
          console.log(data);
        }
      );
  }

}
