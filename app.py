import streamlit as st
from PIL import Image
import tempfile
from ultralytics import YOLO
import time
import os
import requests

# Model setup
MODEL_PATH = "best.pt"
MODEL_URL = "https://drive.google.com/uc?export=download&id=1-Vnf6DjMLnB59ByWH-6grvCIeZ8NBWQB"

def download_weights():
    if not os.path.exists(MODEL_PATH):
        with st.spinner("⏳ Downloading model weights..."):
            r = requests.get(MODEL_URL, stream=True)
            with open(MODEL_PATH, "wb") as f:
                for chunk in r.iter_content(chunk_size=8192):
                    if chunk:
                        f.write(chunk)
        st.success("✅ Model downloaded successfully!")

download_weights()

# Load model
model = YOLO(MODEL_PATH)

# App UI
st.title("🚀 Lunar Rock Detection using YOLOv8x")

with st.sidebar:
    st.header("📊 Model Info")
    st.markdown("""
    **Model:** YOLOv8x  
    **Trained on:**  
    - 9766 Artificial Lunar Images  
    - 8232 Real Cheng Dataset Images  
    **Resolution:** 1024×1024  
    **Class:** Large Lunar Rocks  
    **Params:** ~68M  
    **mAP@0.5:** 0.8024  
    **mAP@0.5:0.95:** 0.5179  
    **Precision:** 0.7692  
    **Recall:** 0.7491  
    """)

uploaded_file = st.file_uploader("📤 Upload a lunar image", type=["jpg", "jpeg", "png"])

if uploaded_file:
    with tempfile.NamedTemporaryFile(delete=False, suffix=".png") as tmp:
        tmp.write(uploaded_file.read())
        image_path = tmp.name

    st.image(Image.open(image_path), caption="🖼️ Uploaded Image", use_container_width=True)

    if st.button("🔍 Detect Rocks"):
        start_time = time.time()
        results = model.predict(image_path, imgsz=1024, conf=0.25)
        end_time = time.time()

        inference_time_ms = (end_time - start_time) * 1000
        result_img = results[0].plot()

        st.image(result_img, caption="🪨 Detected Rocks", use_container_width=True)
        st.success(f"Inference Time: {inference_time_ms:.2f} ms")

        # Save result image
        output_path = os.path.join(tempfile.gettempdir(), "detection_result.png")
        Image.fromarray(result_img).save(output_path)

        with open(output_path, "rb") as f:
            st.download_button(
                label="📥 Download Detection Result",
                data=f,
                file_name="detected_lunar_rocks.png",
                mime="image/png"
            )
