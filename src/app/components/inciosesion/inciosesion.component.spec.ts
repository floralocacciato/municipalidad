import { ComponentFixture, TestBed } from '@angular/core/testing';

import { InciosesionComponent } from './inciosesion.component';

describe('InciosesionComponent', () => {
  let component: InciosesionComponent;
  let fixture: ComponentFixture<InciosesionComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [InciosesionComponent]
    });
    fixture = TestBed.createComponent(InciosesionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
