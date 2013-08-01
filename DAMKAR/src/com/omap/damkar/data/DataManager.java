package com.omap.damkar.data;

public class DataManager {

	private static DataManager data = new DataManager();
	private double latitude;
	private double longitude;

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
}
