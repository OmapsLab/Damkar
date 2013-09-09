package com.omap.damkar;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;

import com.actionbarsherlock.app.SherlockActivity;

public class OutOfArea extends SherlockActivity {

	final Context context = this;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.outofarea);
	}

	@Override
	public void onBackPressed() {
		Intent intent = new Intent(getApplicationContext(), Kebakaran.class);
		startActivity(intent);
		finish();
	}
}
