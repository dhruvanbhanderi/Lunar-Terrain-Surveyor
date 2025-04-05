# 🌕 Lunar Rock Detection using YOLOv8x

🚀 **Accurate detection of large lunar rocks** to support safe rover navigation and lunar lander missions. Built with state-of-the-art YOLOv8x deep learning architecture and trained on over 17,998 annotated lunar images.

---

## 📌 Table of Contents

- [Overview](#overview)
- [Dataset](#dataset)
- [Model Architecture](#model-architecture)
- [Training Details](#training-details)
- [Evaluation Results](#evaluation-results)
- [Streamlit Web App](#streamlit-web-app)
- [Sample Images](#sample-images)
- [Installation](#installation)
- [Usage](#usage)
- [References](#references)

---

## 🧠 Overview

This project automates **detection of large lunar boulders** from satellite and rover imagery using **YOLOv8x** object detection. These rocks are crucial for:
- Geological mapping
- Hazard avoidance in lunar navigation
- Landing site evaluation

Traditional methods involve time-consuming manual labeling — this project solves that with **deep learning automation**.

---

## 🛰️ Dataset

### 🧪 Artificial Dataset
- 9766 synthetically generated lunar images
- Bounding box format: TopLeftX, TopLeftY, Width, Height
- All labeled as ClassID: 1 → converted to YOLO format with ClassID: 0

### 🌑 Real Cheng Dataset
- 8232 real lunar terrain images (Book1–Book5)
- Filtered to include **only ClassID = 1 (rocks)**
- Files renamed as `BookX_Y.png` to avoid conflicts
- YOLO-style normalized labels adjusted to 1024×1024

### 🛠️ Preprocessing
- Resized all images to **1024×1024**
- Denormalized and renormalized bounding boxes
- Combined into unified YOLO format
- 90% training / 10% validation split

---

## 🏗️ Model Architecture

| Parameter        | Value            |
|------------------|------------------|
| Architecture     | YOLOv8x          |
| Layers           | 112 (fused)      |
| Parameters       | ~68M             |
| GFLOPs           | 257.4            |
| Detection Head   | YOLOv8           |
| Backbone         | CSPDarknet53     |
| Neck             | PANet            |

---

## ⚙️ Training Details

- **Epochs**: 200 (Early stopped at 145)
- **Batch size**: 8
- **Optimizer**: SGD with Cosine Decay Learning Rate
- **Augmentations**:
  - Mosaic
  - Horizontal & Vertical Flip
  - HSV jittering
  - Rotation
  - Scaling
- **Test-Time Augmentation (TTA)**: Enabled

---

## 📈 Evaluation Results

| Metric        | Without TTA | With TTA |
|---------------|-------------|----------|
| mAP@0.5       | 0.8024      | 0.8080   |
| mAP@0.5:0.95  | 0.5179      | 0.5195   |
| Precision     | 0.7692      | 0.7681   |
| Recall        | 0.7491      | 0.7559   |

---


## 🧠 Model Weights

Due to GitHub's file size limitations, we host the model weights externally.

✅ On first run, the app will automatically download `best.pt` from Google Drive:
[Download best.pt](https://drive.google.com/file/d/1-Vnf6DjMLnB59ByWH-6grvCIeZ8NBWQB/view?usp=drive_link)

## 🌐 Streamlit Web App

Use the built-in **Streamlit-based frontend** for detection and visualization.

### Features:
- Upload lunar image
- Perform inference
- Measure inference time
- Download detection result

---

## 🖼️ Sample Images

Test the model instantly using images in the `sample/` folder.

| Sample 1                | Sample 2                |
|-------------------------|-------------------------|
| ![Sample 1](sample/104.png) | ![Sample 2](sample/739.png) |

> You can directly upload these into the app to try detection.

---

## 🚀 Try It Online (No Setup Needed)

👉 [Click here to launch the live app](https://your-username-lunar-rock-detector.streamlit.app)

(Replace with actual Streamlit link when deployed)

---

## 💻 Run Locally

```bash
git clone https://github.com/DMANDAVIYA/Lunar-Terrain-Surveyor.git
cd Lunar-Terrain-Surveyor
pip install -r requirements.txt
streamlit run app.py
