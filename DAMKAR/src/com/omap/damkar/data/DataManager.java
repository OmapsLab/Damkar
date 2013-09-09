package com.omap.damkar.data;

import android.graphics.Bitmap;

public class DataManager {

	private static DataManager data = new DataManager();
	private double latitude;
	private double longitude;
	private Bitmap imgBitmap;
	private int idPenngaduan;
	private String photoPath;
	private String phoneNumber;

	private DataManager() {
	}

	public static DataManager getData() {
		return data;
	}

	public void setLatitude(double latitude) {
		this.latitude = latitude;
	}

	public double getLatitude() {
		return latitude;
	}

	public void setLongitude(double longitude) {
		this.longitude = longitude;
	}

	public double getLongitude() {
		return longitude;
	}
	
	public void setImgBitmap(Bitmap imgBitmap) {
		this.imgBitmap = imgBitmap;
	}
	
	public Bitmap getImgBitmap() {
		return imgBitmap;
	}
	
	public void setIdPenngaduan(int idPenngaduan) {
		this.idPenngaduan = idPenngaduan;
	}
	
	public int getIdPenngaduan() {
		return idPenngaduan;
	}
	
	public void setPhotoPath(String photoPath) {
		this.photoPath = photoPath;
	}
	
	public String getPhotoPath() {
		return photoPath;
	}
	
	public void setPhoneNumber(String phoneNumber) {
		this.phoneNumber = phoneNumber;
	}
	
	public String getPhoneNumber() {
		return phoneNumber;
	}
}
