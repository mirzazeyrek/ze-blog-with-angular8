import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import { AppComponent } from './app.component';
import { TopBarComponent } from './top-bar/top-bar.component';
import { ProductListComponent } from './product-list/product-list.component';
import { ProductAlertsComponent } from './product-alerts/product-alerts.component';
import { ProductDetailsComponent } from './product-details/product-details.component';
import { CartService } from './cart.service';
import { CartComponent } from './cart/cart.component';
import { ShippingComponent } from './shipping/shipping.component';
import { PostListComponent } from './post-list/post-list.component';
import { PostDetailsComponent } from './post-details/post-details.component';
import { PostComponent } from './post/post.component';
import { PostFormComponent } from './post-form/post-form.component';
import { PostService } from './post.service';

@NgModule({
  imports: [
    BrowserModule,
    HttpClientModule,
    ReactiveFormsModule,
    RouterModule.forRoot([
      {path: 'products/:productId', component: ProductDetailsComponent},
      {path: 'cart', component: CartComponent},
      {path: 'shipping', component: ShippingComponent},
      // Home page with post lists.
      {path: '', component: PostListComponent},
      // Post edit page.
      {path: 'post/edit/:postId', component: PostFormComponent},
      // Post create page.
      {path: 'post/create', component: PostFormComponent},
      // Post detail page.
      {path: 'post/:postId', component: PostDetailsComponent},
    ]),
    FormsModule
  ],
  declarations: [
    AppComponent,
    TopBarComponent,
    ProductListComponent,
    ProductAlertsComponent,
    ProductDetailsComponent,
    CartComponent,
    ShippingComponent,
    PostListComponent,
    PostDetailsComponent,
    PostComponent,
    PostFormComponent,
  ],
  bootstrap: [ AppComponent ],
  providers: [
    CartService,
    PostService
  ]
})
export class AppModule { }


/*
Copyright Google LLC. All Rights Reserved.
Use of this source code is governed by an MIT-style license that
can be found in the LICENSE file at http://angular.io/license
*/
