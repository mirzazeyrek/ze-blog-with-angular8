import { Component, OnInit } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {FormBuilder, FormControl, FormGroup} from '@angular/forms';
import {CartService} from '../cart.service';
import {Router} from '@angular/router';
import {ActivatedRoute} from '@angular/router';

@Component({
  selector: 'app-post-form',
  templateUrl: './post-form.component.html',
  styleUrls: ['./post-form.component.css']
})
export class PostFormComponent implements OnInit {
  postForm;
  status;

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

  getPostDetails() {
    this.route.paramMap.subscribe(params => {
      if (params.get('postId')) {
      this.http.get('api/post/detail/' + params.get('postId') ).subscribe(
        (data: any) => {
          this.postForm = this.formBuilder.group(data.post);
        }
      );
      }
    });
  }

  onSubmit(postData) {
    this.postForm.reset();
    this.status = 'Sent! Thx baby.';
    const formData = new FormData(); 
    formData.append('id', postData.id);
    formData.append('title', postData.title);
    formData.append('text', postData.text);
    this.http.post('api/post/create', formData).subscribe(
      (data: any ) => {
        this.router.navigate(['post/' + data.post.id ]);
      });
    console.warn('Your post has been submitted 2 ', postData);
  }
}
