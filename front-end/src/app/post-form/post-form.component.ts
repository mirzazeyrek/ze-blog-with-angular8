import { Component, OnInit } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {FormBuilder, FormControl, FormGroup} from '@angular/forms';
import {CartService} from '../cart.service';
import {Router} from '@angular/router';
import {ActivatedRoute} from '@angular/router';
import {Post, PostResponse} from '../../post';

@Component({
  selector: 'app-post-form',
  templateUrl: './post-form.component.html',
  styleUrls: ['./post-form.component.css']
})
export class PostFormComponent implements OnInit {
  public postForm;
  public status;

  constructor(
    private cartService: CartService,
    private formBuilder: FormBuilder,
    private http: HttpClient,
    private router: Router,
    private route: ActivatedRoute,
  ) {
    this.postForm = this.formBuilder.group({
      id: '',
      title: '',
      text: ''
    });
  }

  ngOnInit() {
    this.getPostDetails();
  }

  public getPostDetails(): void {
    this.route.paramMap.subscribe(params => {
      if (!params.get('postId')) {
        return;
      }

      this.http.get('api/post/detail/' + params.get('postId') ).subscribe(
        (data: PostResponse) => {
          this.postForm = this.formBuilder.group(data.post);
        }
      );
    });
  }

  public onSubmit(postData: Post): void {
    this.postForm.reset();
    this.status = 'Sent! Thx baby.';
    const formData = new FormData();
    formData.append('id', '' + postData.id);
    formData.append('title', postData.title);
    formData.append('text', postData.text);
    this.http.post('api/post/create', formData).subscribe(
      (data: Post ) => {
        this.router.navigate(['post/' + data.id ]);
      });
    console.warn('Your post has been submitted.', postData);
  }
}
